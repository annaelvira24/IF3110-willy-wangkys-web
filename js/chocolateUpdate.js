var funcUpdateStock = 
    function updateStock() {
        console.log(id);

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById("mainField").innerHTML = "";
            document.getElementById("details").innerHTML = this.responseText;
            var stock = document.getElementById("stock").innerHTML;
            var stock_amount = stock.split(": ")[1];
            if(stock_amount == "0"){
                document.getElementById("buy-button").disabled = true;
            }
            else{
                document.getElementById("buy-button").disabled = false;
            }
        }
        };
        xmlhttp.open("GET","updateStock.php?id="+id,true);
        xmlhttp.send();
    }

setInterval(funcUpdateStock,5000);
// console.log(id);
// var functionRef = function showAlert() {
//     alert("Welcome!!");
// }

// // pass variable as reference to the function
// setInterval(functionRef, 5000);
