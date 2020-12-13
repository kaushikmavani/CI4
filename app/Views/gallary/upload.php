<?= $this->extend('layouts/main.php') ?>

<?= $this->section('title') ?>
Use Dropzone
<?= $this->endSection() ?>

<?= $this->section('head_script') ?>
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet"> -->
<style type="text/css">
  html, body {
    height: 100%;
  }
  #actions {
    margin: 15px 10px;
  }


  /* Mimic table appearance */
  div.table {
    display: table;
  }
  div.table .file-row {
    display: table-row;
  }
  div.table .file-row > div {
    display: table-cell;
    vertical-align: top;
    border-top: 1px solid #ddd;
    padding: 8px;
  }
  div.table .file-row:nth-child(odd) {
    background: #f9f9f9;
  }

  /* The total progress gets shown by event listeners */
  #total-progress {
    opacity: 0;
    transition: opacity 0.3s linear;
  }

  /* Hide the progress bar when finished */
  #previews .file-row.dz-success .progress {
    opacity: 0;
    transition: opacity 0.3s linear;
  }

  /* Hide the delete button initially */
  #previews .file-row .delete {
    display: none;
  }

  /* Hide the start and cancel buttons and show the delete button */

  #previews .file-row.dz-success .start,
  #previews .file-row.dz-success .cancel {
    display: none;
  }
  #previews .file-row.dz-success .delete {
    display: block;
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Use Dropzone</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('gallary') ?>">Manage Gallary</a></li>
              <li class="breadcrumb-item active">Use Dropzone</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Use Dropzone</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <div id="actions" class="row">

                <div class="col-lg-6">
                  <!-- The fileinput-button span is used to style the file input field as button -->
                  <span class="btn btn-sm btn-success fileinput-button">
                      <i class="fa fa-plus"></i>
                      <span>Add files...</span>
                  </span>
                  <span id="display_button" style="display: none;">
                    <button type="submit" class="btn btn-sm btn-info start">
                        <i class="fa fa-upload"></i>
                        <span>Start upload</span>
                    </button>
                    <button type="reset" class="btn btn-sm btn-danger cancel">
                        <i class="fa fa-ban"></i>
                        <span>Cancel upload</span>
                    </button>
                  </span>
                </div>

                <div class="col-lg-6 text-right">
                  <a href="<?= base_url('gallary') ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View All</a>
                </div>
                <div class="col-lg-12" style="padding-top: 15px;">
                  <!-- The global file processing state -->
                  <span class="fileupload-process">
                    <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                  </span>
                </div>
              </div>
              <div class="table table-striped files" id="previews">

                <div id="template" class="file-row">
                  <!-- This is used as the file preview template -->
                  <div>
                      <span class="preview"><img data-dz-thumbnail /></span>
                  </div>
                  <div>
                      <p class="name" data-dz-name></p>
                      <strong class="error text-danger" data-dz-errormessage></strong>
                  </div>
                  <div>
                      <p class="size" data-dz-size></p>
                      <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                      </div>
                  </div>
                  <div>
                    <button class="btn btn-sm btn-info start">
                        <i class="fa fa-upload"></i>
                        <span>Upload</span>
                    </button>
                    <button data-dz-remove class="btn btn-sm btn-danger cancel">
                        <i class="fa fa-ban"></i>
                        <span>Cancel</span>
                    </button>
                    <!-- <button data-dz-remove class="btn btn-sm btn-danger delete">
                      <i class="fa fa-trash"></i>
                      <span>Delete</span>
                    </button> -->
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?= $this->endSection(); ?>

<?= $this->section('footer_script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script type="text/javascript">

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "upload_image", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.

  });

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    $('#display_button').css('display', 'inline-block');
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
  });

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
  });

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
  });

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
  });

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
  };
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
  };
</script>
<?= $this->endSection(); ?>