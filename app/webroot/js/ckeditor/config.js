/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.on( 'dialogDefinition', function( ev ) {
   var dialogName = ev.data.name;
   var dialogDefinition = ev.data.definition;
   if ( dialogName == 'image' ) {
         dialogDefinition.removeContents( 'Link' );
         dialogDefinition.removeContents( 'advanced' );
         dialogDefinition.removeContents( 'Upload' );
   }
});
CKEDITOR.editorConfig = function( config )
{
     config.enterMode = CKEDITOR.ENTER_BR;
    config.toolbar = 'MyToolbar';
 
	config.toolbar_MyToolbar =
	[
		
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'styles', items : [ 'Styles','Format' ] },
                '/',
		{ name: 'document', items : [ 'NewPage','Preview' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		
	];
//	config.filebrowserBrowseUrl = 'rop/app/webroot/upload/type=files';
//   config.filebrowserImageBrowseUrl = 'rop/app/webroot/upload/?type=images';
////   config.filebrowserFlashBrowseUrl = 'rop/app/webroot/upload/?type=flash';
////   config.filebrowserUploadUrl = 'rop/app/webroot/upload/?type=files';
////   config.filebrowserImageUploadUrl = 'rop/app/webroot/upload/?type=images';
//   config.filebrowserFlashUploadUrl = 'rop/app/webroot/upload/?type=flash';

 config.extraPlugins = "youtube";
 
 config.toolbar = [
['Preview'],
['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Print', 'SpellChecker'],
['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
['Link','Unlink','Anchor'], ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar'],
['Font','FontSize'],
['TextColor','BGColor', '-', 'Source', 'YouTube']

];



};
	   