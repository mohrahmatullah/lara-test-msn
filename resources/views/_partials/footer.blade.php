<!-- Footer -->
	<footer class="py-5 bg-dark" style="margin-top: 35rem;">
		<div class="container">
		  <p class="m-0 text-center text-white">Copyright &copy; Shop 2020</p>
		</div>
	<!-- /.container -->
	</footer>

	<!-- Bootstrap core JavaScript -->
	<script src="{{url('assets/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<!-- Import Sweetalert -->
	<script src="{{url('assets/sweetalert/sweetalert.min.js')}}"></script>
	<script type="text/javascript">
	    $(".remove-cart").click(function(){
        	const id_cart = $(this).data('id');
        	const id_produk = $(this).data('id_produk');
        	const qty = $(this).data('qty');
	    
			swal({
				title: "Are you sure?",
				text: "You will not be able to recover this imaginary file!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel plx!",
				closeOnConfirm: false,
				closeOnCancel: false
			},
			function(isConfirm) {
				if (isConfirm) {
				  $.ajax({
				     url: '/delete-cart/'+id_cart+'/'+id_produk+'/'+qty,
				     type: 'DELETE',
				     error: function() {
				        alert('Something is wrong');
				     },
				     success: function(data) {
				          // $("#"+id).remove();
				          swal("Deleted!", "Your imaginary file has been deleted.", "success");
				     }
				  });
				} else {
				  swal("Cancelled", "Your imaginary file is safe :)", "error");
				}
			});
	     
	    });

	    $('.sort-by-category').on('change', function() {
	        window.location.href = replaceUrl(window.location.href, "category", $(this).val());
	      })
	    function replaceUrl(url, paramName, paramValue){
	      if(paramValue == null)
	          paramValue = '';
	      var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)');
	      if(url.search(pattern)>=0){
	          return url.replace(pattern,'$1' + paramValue + '$2');
	      }
	      return url + (url.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
	    }
	    var btnexportexcel = document.getElementById('btnexcel');
	    btnexportexcel.onclick = function () {
            fnExcelReport();
        }
	    function fnExcelReport() {
		    var tab_text;
		    var textRange;
		    var j = 0;
		    var tab = document.getElementById('exportcel'); // id of table

		    for (j = 0; j < tab.rows.length; j++) {
		        if (j == 0) {
		            tab_text = "<table width=50% border='1px'><tr>";
		            var head = "Data Product";
		            if (head != null) {
		                tab_text = tab_text + "<th colspan='" + tab.rows[j].getElementsByTagName("TH").length + "' >" + head[0].innerHTML + "</th></tr>";
		            }
		        }
		        tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";

		    }

		    tab_text = tab_text + "</table>";
		    tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
		    tab_text = tab_text.replace(/<h2[^>]*>/g, "<b>"); //remove if u want links in your table
		    tab_text = tab_text.replace(/<\/h2>/g, "</b>"); //remove if u want links in your table
		    tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
		    tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
		    tab_text = tab_text.replace(/style="display:none/gi, "");
		    var ua = window.navigator.userAgent;
		    var msie = ua.indexOf("MSIE ");
		    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
		    {
		        txtArea1.document.open("txt/html", "replace");
		        txtArea1.document.write(tab_text);
		        txtArea1.document.close();
		        txtArea1.focus();
		        sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xlsx");
		    } else { //other browser not tested on IE 11
		        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
		    }

		    // formatLagi(idtable);
		    return (sa);
		}
	</script>
</body>

</html>