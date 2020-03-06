
<script src="assets/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
            $(document).ready(function () {
                if($(".form-html").length > 0){
                   tinymce.init({
   						
						selector: "textarea.form-html",
                        theme: "modern",
						menubar: false,
						language: 'pt_BR',
						language_url : 'assets/tinymce/langs/pt_BR.js',
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "save table contextmenu directionality emoticons template paste textcolor"
                        ],
                        toolbar: "fontselect fontsizeselect | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview fullpage | forecolor backcolor ",
  
					  // enable title field in the Image dialog
					  image_title: true, 
					  // enable automatic uploads of images represented by blob or data URIs
					  automatic_uploads: true,
					  // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
					  images_upload_url: 'upload_images.php',
					  theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
						font_size_style_values : "10px,12px,13px,14px,16px,18px,20px",
					  // here we add custom filepicker only to Image dialog
					  file_picker_types: 'image', 
					  // and here's our custom image picker
					  file_picker_callback: function(cb, value, meta) {
						var input = document.createElement('input');
						input.setAttribute('type', 'file');
						input.setAttribute('accept', 'image/*');
    
						// Note: In modern browsers input[type="file"] is functional without 
						// even adding it to the DOM, but that might not be the case in some older
						// or quirky browsers like IE, so you might want to add it to the DOM
						// just in case, and visually hide it. And do not forget do remove it
						// once you do not need it anymore.
					
						input.onchange = function() {
						  var file = this.files[0];
						  
						  var reader = new FileReader();
						  reader.onload = function () {
							// Note: Now we need to register the blob in TinyMCEs image blob
							// registry. In the next release this part hopefully won't be
							// necessary, as we are looking to handle it internally.
							var id = 'blobid' + (new Date()).getTime();
							var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
							var base64 = reader.result.split(',')[1];
							var blobInfo = blobCache.create(id, file, base64);
							blobCache.add(blobInfo);
					
							// call the callback and populate the Title field with the file name
							cb(blobInfo.blobUri(), { title: file.name });
						  };
						  reader.readAsDataURL(file);
						};
						
						input.click();
  				}
});
                }
            });
</script>