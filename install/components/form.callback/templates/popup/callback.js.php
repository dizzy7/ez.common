<?header('Content-type: application/javascript');?>
var fb;
$(function(){
    fb = $("#callback_popup").fancybox({
        minWidth    : 300,
        fitToView	: true,
        autoSize	: true,
        closeClick	: false,
        openEffect	: 'none',
        closeEffect	: 'none'
    });


    var form = $("#callback_form");
    form.on('submit',handleSubmit);

    function handleSubmit(e){
            e.preventDefault();
            var formdata = (form.serialize());
            formdata += '&submit=Y';
            $.fancybox.showLoading();
            $.post('<?=$_REQUEST['path']?>',formdata,function(data){
                $.fancybox.hideLoading();
                var newform = $(data).find("#zcontainer");
                $("#zcontainer").replaceWith(newform);

                form = $("#callback_form");
                form.on('submit',handleSubmit);
                $.fancybox.update();
            });
        }
});
