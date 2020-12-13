<?= $this->extend('layouts/main.php') ?>

<?= $this->section('title') ?>
Languages
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Languages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Languages</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-6">
                        <h3 class="card-title">Manage Languages</h3>
                      </div>
                      <div class="col-sm-6 text-right">
                        Select Language: 
                        <select onchange="set_language(this)">
                        	<option value="en" <?php if(\Config\Services::session()->get('locale') == 'en') { echo 'selected'; } ?>>English</option>
                        	<option value="fr" <?php if(\Config\Services::session()->get('locale') == 'fr') { echo 'selected'; } ?>>Franch</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	<p><?= lang('lang.selected language', [], \Config\Services::session()->get('locale')) ?><strong style="margin-left: 10px;"><?= lang('lang.language') ?></strong></p>
              	<p><?= lang('lang.content', [], \Config\Services::session()->get('locale')) ?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?= $this->endSection() ?>

<?= $this->section('footer_script') ?>
<script type="text/javascript">
	function set_language(lang)
	{
		var language = $(lang).val();
		var url = '<?= base_url('language/change') ?>';
		$.ajax({
			type: 'POST', 
			url: url,
			data: {
				'language': language
			},
			success: function(data)
			{
				toastr.success("<?= lang('lang.Your language changed successfully!', [], \Config\Services::session()->get('locale')) ?>");

            	setInterval(function(){ location.reload(); }, 4000);
			}
		});	
	}
</script>
<?= $this->endSection(); ?>