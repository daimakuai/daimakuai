$.fn.editable.defaults.params = function (params) {
    params._token = LA.token;
    params._editable = 1;
    params._method = 'PUT';
    return params;
};

toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 4000
};


$.pjax.defaults.timeout = 5000;
$.pjax.defaults.maxCacheLength = 0;
$(document).pjax('a:not(a[target="_blank"])', {
    container: '#pjax-container'
});

// $(document).on('click', 'a', function(event) {
//     addTabsTo($(this),event);
//     var id = $(this).attr('id');
//     if(id!="" && id!=undefined){
//         //$.pjax({ url: $(this).attr('href'), container: '#tab-content' });
//         //$.pjax.click(event,  '#tab-content');
//     }
// });

NProgress.configure({ parent: '#pjax-container' });

$(document).on('pjax:timeout', function(event) { event.preventDefault(); })

$(document).on('submit', 'form[pjax-container]', function(event) {
    $.pjax.submit(event, '#pjax-container')
});


$(document).on("pjax:popstate", function() {

    $(document).one("pjax:end", function(event) {
        $(event.target).find("script[data-exec-on-popstate]").each(function() {
            $.globalEval(this.text || this.textContent || this.innerHTML || '');
        });
    });
});

$(document).on('pjax:send', function(xhr) {
    if(xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
        $submit_btn = $('form[pjax-container] :submit');
        if($submit_btn) {
            $submit_btn.button('loading')
        }
    }
    NProgress.start();
});

$(document).on('pjax:complete', function(xhr) {
    if(xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
        $submit_btn = $('form[pjax-container] :submit');
        if($submit_btn) {
            $submit_btn.button('reset')
        }
    }
    NProgress.done();
});

$(function(){

    $('.sidebar-menu li:not(.treeview) > a').on('click', function(){
        var $parent = $(this).parent().addClass('active');
        $parent.siblings('.treeview.active').find('> a').trigger('click');
        $parent.siblings().removeClass('active').find('li').removeClass('active');
    });

    $('[data-toggle="popover"]').popover();
});

(function($){
    $.fn.admin = LA;
    $.admin = LA;

})(jQuery);

function addTabsTo(tar,event){

    App.setbasePath("/vendor/daimakuai-admin/AdminLTE/");
    App.setGlobalImgPath("dist/img/");
    //App.setRememberTabs(true);

    //addTabs({id: '999999999',title: '欢迎页',close: false,url: '{{ route(\'welcome\') }}'});

    // $('body').delegate('a','click',function(event){

    // href = event.currentTarget.activeElement.href;
    // id = event.currentTarget.activeElement.id;
    // title = event.currentTarget.activeElement.href.innerText;
    // target = event.currentTarget.activeElement.target;

    href = tar.attr('href');
    id = tar.context.id;
    title = tar.context.innerText;
    target = tar.context.target;

    if(href!="#" && href!="" && target!="_blank" && href!='javascript:void(0);'){

        if(id==""){
            id = Math.random() * 200;
            tar.attr('id',id);
        }

        if(title==""){
            title = '新页面'+id;
        }
        //$.get(tar.href, function(result){
        //    if(result){
        //        addTabs({id: id,title: title,close: true,url: href,content:result});
        //    }else{
        addTabs({id: id,title: title,close: true,url: href});
        //   }

        // });
        //event.preventDefault();

        var rightName = 'rightIframe_' + id
        $("#tab-content [data-pageid='"+id+"']").attr('id',rightName);
        // var containerSelector = "#"+rightName;

    }



    // });

    // $.get('{{ route(\'welcome\') }}', function(result){
    //     addTabs({id: '999999999',title: '欢迎页',close: false,url: '{{ route(\'welcome\') }}',content:result});
    // });

    /* if($.cookie('tabs_cookies')){
        tabs_cookies = $.cookie('tabs_cookies').split('||');
    }else{
        tabs_cookies = [];
        //tabs_cookies.push();
    }

    $.each(tabs_cookies, function(i, v) {
        value = JSON.parse(v);
        if(value.id){
            addTabs(value);
        }
    });*/



    App.fixIframeCotent();

}