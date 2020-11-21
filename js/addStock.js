function increment(e) {
    e.preventDefault();
      document.getElementById("amount-buy-num").stepUp();
  }
  
  function decrement(e) {
    e.preventDefault();
    if(document.getElementById("amount-buy-num").value > 1){
        document.getElementById("amount-buy-num").stepDown();
    } 
  }
  
  function cancel(e, id){
    e.preventDefault();
    window.location.href='detailsPage.php?id='+id;
  }