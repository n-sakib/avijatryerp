var Controls = {
    init: function (id) {
        var imgLink = document.getElementById(id);
        imgLink.addEventListener('mouseover', Controls.mouseOverListener, false );
        imgLink.addEventListener('mouseout', Controls.mouseOutListener, false );
        
    },
    
    mouseOverListener: function ( event ) {
        Controls.displayTooltip ( this );

        //alert(imgLink);
    },
    
    mouseOutListener: function ( event ) {
        Controls.hideTooltip ( this );
    },
    
    displayTooltip: function ( imgLink ) {
        var tooltip = document.createElement ( "div" );
        var fullImg = document.createElement ( "img" );
        
        fullImg.src = imgLink.href;
        fullImg.style.maxWidth = "200px";
        fullImg.style.maxHeight = "200px";
        tooltip.appendChild ( fullImg );
        tooltip.className = "imgTooltip";
        
        tooltip.style.top =  "-350";
        
        imgLink._tooltip = tooltip;
        Controls._tooltip = tooltip;
        imgLink.parentNode.appendChild ( tooltip );
        
        imgLink.addEventListener ( "mousemove", Controls.followMouse, false);
    },
    
    hideTooltip : function ( imgLink ) {
        imgLink.parentNode.removeChild ( imgLink._tooltip );
        imgLink._tooltip = null;
        Controls._tooltip = null;
    },
    
    mouseX: function ( event ) {
        if ( !event ) event = window.event;
        if ( event.pageX ) return event.pageX;
        else if ( event.clientX ) 
            return event.clientX + (document.documentElement.scrollLeft ?
                                    document.documentElement.scrollLeft :                 
                                    document.body.scrollLeft); 
        else return 0;
    },
    
    mouseY: function ( event ) {
        if (!event) event = window.event; 
        if (event.pageY) return event.pageY; 
        else if (event.clientY) 
            return event.clientY + (document.documentElement.scrollTop ?     
                                    document.documentElement.scrollTop : 
                                    document.body.scrollTop); 
        else return 0;
    },
    
    followMouse: function ( event ) {
        var tooltip = Controls._tooltip.style;
        var offX = -8, offY = -215;
        
        tooltip.left = (parseInt(Controls.mouseX(event))+offX) + 'px';
        tooltip.top = (parseInt(Controls.mouseY(event))+offY) + 'px';
    }       
}
//Controls.init();
function newPopup(url) {
    popupWindow = window.open(
        url,'popUpWindow','height=500,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}
$(document).ready(function() {
    $('a').click(function(event) {
        var className = $(this).attr('class');
        //alert(className);
        if(className === 'pids'){   
            event.preventDefault();
        }
    });
});