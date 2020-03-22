// example
var el = document.createElement('div');
el.className = 'dropz p-4';
el.innerHTML = '<p class="text-center">Drop/Upload file here</p>';

var referenceNode = document.querySelector('div.media_dropzone');
referenceNode.parentNode.insertBefore(el, referenceNode);

var myDropzone = new Dropzone(".dropz", { url: "/file/post"});
