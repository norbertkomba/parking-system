 //a jquery plugin that prints the given element.
 jQuery.fn.print = function(){
    // NOTE: We are trimming the jQuery collection down to the
    // first element in the collection.
        if (this.size() > 1){
            this.eq( 0 ).print();
            return;
        } else if (!this.size()){
            return;
        }
    
    // ASSERT: At this point, we know that the current jQuery
    // collection (as defined by THIS), contains only one
    // printable element.
    
    // Create a random name for the print frame.
        var strFrameName = ("printer-" + (new Date()).getTime());
    
    // Create an iFrame with the new name.
        var jFrame = $( "<iframe name='" + strFrameName + "'>" );
    
    // Hide the frame (sort of) and attach to the body.
        jFrame
            .css( "width", "1px" )
            .css( "height", "1px" )
            .css( "position", "absolute" )
            .css( "left", "-9999px" )
            .appendTo( $( "body:first" ) )
        ;
    
    // Get a FRAMES reference to the new frame.
        var objFrame = window.frames[ strFrameName ];
    
    // Get a reference to the DOM in the new frame.
        var objDoc = objFrame.document;
    
    // Grab all the style tags and copy to the new
    // document so that we capture look and feel of
    // the current document.
    
    // Create a temp document DIV to hold the style tags.
    // This is the only way I could find to get the style
    // tags into IE.
        var jStyleDiv = $( "<div>" ).append(
            $( "style" ).clone()
        );
    // Write the HTML for the document. In this, we will
    // write out the HTML of the current element.
        objDoc.open();
        objDoc.write( "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">" );
        objDoc.write( "<html>" );
        objDoc.write( "<head>" );
        objDoc.write( "<title>" );
        objDoc.write( document.title );
        objDoc.write( "</title>" );
        objDoc.write("<style>");
        objDoc.write("" +
            "@media print { " +
                ".page-footer{} " +
                ".page-header{} " +
                "#printableTable { " +
                    "margin-bottom: 15px;" +
                    "width:100%;  " +
                    "border:1px solid #000000;" +
                    "border-collapse:collapse;  " +
                    "padding:2px; font-size: 12px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;width : 100%;" +
                "}  " +
                "#printableTable th {  " +
                    "border:1px solid #000000;  " +
                    "padding:2px; " +
                    "background:#F0F0F0;" +
                "}" +
                "#printableTable td {  " +
                    "border:1px solid #000000;" +
                    "padding:2px;" +
                "}" +
                "#printableTable thead {" +
                    "display: table-header-group;" +
                "} " +
                ".page-break{ " +
                    "display: block; " +
                    "page-break-after: always;" +
                "}" +
                ".center{" +
                    "text-align:center;" +
                "}" +
                ".vText{" +
                    "writing-mode: vertical-lr;" +
                    "-ms-writing-mode: tb-rl;" +
                    "transform: rotate(180deg);" +
                "}"+
                ".number-input{" +
                    "width: 25px;" +
                    "border: none;" +
                    "background-color: inherit;" +
                "}"+
            "}");
        objDoc.write("</style>");
        objDoc.write( jStyleDiv.html() );
        objDoc.write( "</head>" );
        objDoc.write( "<body style=font-size:12px;width:98%;>");
        objDoc.write("<img src='"+base_url()+"assets/images/hti-logo.png' style='opacity: 0.1;position: fixed;top: 47%;left: 45%;min-height: 50px;max-height: 100px;min-width: 50px;max-width: 100px;'>");
        objDoc.write( this.html() );
        objDoc.write( "</body>" );
        objDoc.write( "</html>" );
        objDoc.close();
    
    // Print the document.
        objFrame.focus();
        objFrame.print();
    
    // Have the frame remove itself in about a minute so that
    // we don't build up too many of these frames.
        setTimeout(
            function(){
                jFrame.remove();
            },
            (60 * 1000)
        );
    };