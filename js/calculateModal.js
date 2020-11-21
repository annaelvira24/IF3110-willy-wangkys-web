function calcItemPrice(amount, price){
    return (amount * price);
}

function calcAllPrice(e, arr){
    e.preventDefault();
    let total = 0;
    console.log(arr, typeof arr)

    for(var i=0; i<arr.length; i++){
        amount = document.getElementById(i).value;
        console.log(amount)

        price = arr[i].harga_satuan;     
        console.log(price)
        total += calcItemPrice(amount, price);
    }
    document.getElementById("total-modal").innerHTML = total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
}