/**
 *
 *
 * copy by cha.sky31.com
 */
function setImagePreview() {

    var docObj=document.getElementById("userinfoform-uploadheadimg");
    var imgObjPreview=document.getElementById("preview");
    if(docObj.files &&    docObj.files[0]){

        imgObjPreview.style.display = 'block';
        imgObjPreview.style.width = '170px';
        imgObjPreview.style.height = '170px';

        imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
        document.getElementById('em-img').style.display = 'none';
        document.getElementById("img").style.marginTop = '20px';
    }else{

        docObj.select();
        var imgSrc = document.selection.createRange().text;
        var localImagId = document.getElementById("img");

        localImagId.style.width = "170px";
        localImagId.style.height = "170px";

        document.getElementById('em-img').style.display = 'none';
        localImagId.style.marginTop = '20px';
        try{
            localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
            localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
        }catch(e){
            alert("error!");
            return false;
        }
        imgObjPreview.style.display = 'none';
        document.selection.empty();
    }
    return true;
}