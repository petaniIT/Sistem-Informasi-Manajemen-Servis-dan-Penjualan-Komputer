
<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM supplier";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row-fluid">
	<div class="span12">
<h3 class="header smaller lighter blue">DATA SUPPLIER</h3>
    <a href="?page=Supplier-Add" target="_self"><div class="table-header">ADD DATA</div></a>
<table id="sample-table-2" class="table table-striped table-bordered table-hover">
 <thead>
      <tr>
        <th width="43"><b>No</b></th>
        <th width="339"><b>Nama Supplier </b></th>
        <th width="197"  class="hidden-480"><b>Kabupaten/Kota</b></th>
        <th width="397"  class="hidden-480"><b>Alamat lengkap</b></th>
        <th width="197"  class="hidden-480"><b>No Telepon</b></th>
        <th ><b>Aksi</b><b></b></th>
        </tr>
 </thead>
      <?php
	$mySql = "SELECT supplier.*, kabupaten.nm_kabupaten FROM supplier LEFT JOIN kabupaten ON supplier.kd_kabupaten=kabupaten.kd_kabupaten ORDER BY kd_supplier ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_supplier'];
	?>
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['nm_supplier']; ?></td>
        <td><?php echo $myData['nm_kabupaten']; ?></td>
        <td><?php echo $myData['alamat']; ?></td>
         <td><?php echo $myData['no_telepon']; ?></td>
        <td width="222" align="center"><a href="?page=Supplier-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data" class="icon-edit bigger-120" title="Edit"></a>
      <a href="?page=Supplier-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" title="Delete" class="icon-trash bigger-120" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA SUPPLIER INI ... ?')"></a></td>
      </tr>
      <?php } ?>
    </table>
    </div></div>


	<script src="assets/js/jquery.min.js"></script>


		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>

		
		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null,null,null,null
				  { "bSortable": false }
				] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			})
		</script>