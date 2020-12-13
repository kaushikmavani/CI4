<!DOCTYPE html>
<html>
<head>
	<title>Email verify</title>
	<style type="text/css">
		td {
			margin-bottom: 20px;
			display: inline-block;
		}
		h3 {
			margin: 0;
    		display: inline-block;
		}
		p {
			margin: 0;
		}
		a {
			background-color: #17a2b8;
		    color: #fff;
		    border-radius: 5px;
		    padding: 10px 20px;
		    display: inline-block;
		    text-decoration: none;
		}
	</style>
</head>
<body>

	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>Hello <h3><?= $username ?></h3></td>
		</tr>
		<tr>
			<td><p>If you want to activate your account then click on following button:</p></td>
		</tr>
		<tr>
			<td><a href="<?= $url ?>">Verify Email</a></td>
		</tr>
		<tr>
			<td>Thank you.</td>
		</tr>
	</table>

</body>
</html>