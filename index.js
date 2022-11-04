
// select all items of news
const items = $("div");

// set their display attribute to none at first 
items.css('display','none');


// using delay to differentiate the items
// using fadeIn() in jQeury to implement the fade in effect
  items.each(function(index){
    $(this).delay(index*400).fadeIn(500);
  })

