</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
	</div>
	<!--end wrapper-->
	
	<!-- scripts have been moved to header -->

	<script>
		
		$(document).ready(function () {
			$('#image-uploadify').imageuploadify();
            $("#metismenu").metisMenu();
        });

        if ( $( "#editor" ).length ) {
            ClassicEditor.create(document.querySelector('#editor')).catch(error => {
                console.error(error);
            });
        }

	</script>
	<script src="/_/admin/js/app.js"></script>
</body>

</html>