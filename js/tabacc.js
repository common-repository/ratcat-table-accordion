jQuery(function($) {

    var $el, $parentWrap, $otherWrap, 
        $allTitles = $("dt").css({
            padding: 5, 
            "cursor": "pointer",
            "fontWeight": "normal",
            "lineHeight": "130%"
        }),
        $allCells = $("dd").css({
            position: "relative",
            top: 0,
            left: 0,
            display: "none"
        });
    
      
    $(".page-wrap").delegate("a.image","click", function(e) { 
        
        if ( !$(this).parent().hasClass("curCol") ) {         
            e.preventDefault(); 
            $(this).next().find('dt:first').click(); 
        } 
        
    });
    
    $(".page-wrap").delegate("dt", "click", function() {
        
        $el = $(this);
        if (!$el.hasClass("current")) {
            $parentWrap = $el.parent().parent();
            $otherWraps = $(".gridacc").not($parentWrap);
            $allTitles = $("dt").not(this);
            $allCells.slideUp();
            $allTitles.animate({
                fontSize: "16px",
                paddingTop: 5,
                paddingRight: 5,
                paddingBottom: 5,
                paddingLeft: 5
            });
           
            $el.animate({
                "font-size": "20px",
                paddingTop: 10,
                paddingRight: 5,
                paddingBottom: 0,
                paddingLeft: 10
            }).next().slideDown();

            $parentWrap.animate({
                width: 320
            }).addClass("curCol");

            $otherWraps.animate({
                width: 140
            }).removeClass("curCol");

            $allTitles.removeClass("current");
            $el.addClass("current");  
        
        }
        
    });
    
});