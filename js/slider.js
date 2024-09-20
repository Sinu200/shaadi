$(function () {
  
    var container = $(".slide-bottom");
    var slideShow = container.find(".slide-show");
    var slideImg = slideShow.find(".slide-image");
    var slides = slideImg.find(".slide>img");

    var slideCount = slides.length;
    var slideWidth = slides.innerWidth();
    var show_num = 3;
    var num = 0;

    var slideCopy = $(".slide:lt(" + show_num + ")").clone();
    
    
    slideImg.append(slideCopy);

    function next() {
        if (num == slideCount) {
            num = 0;
            slideImg.css("margin-left", -num * slideWidth + "px");
        }
        num++;
        // console.log(num);
        
        slideImg.animate({ "margin-left": -slideWidth * num + "px" },3000, function() {
            // Call the next function again to create the loop
            console.log(`"margin-left": ${-slideWidth * num} + "px" `);
            
            next();
        });
    }

    // Start the infinite sliding effect
    next();
});

