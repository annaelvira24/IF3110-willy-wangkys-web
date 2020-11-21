function showNextSearch() {

    for(let i = 5*count; i < 5*(count+1); i++) {
        item = document.getElementsByClassName("result-card")[i];
        item.style.display = 'none';
    }
    for(let i = 5*(count+1); i < (count+2)*5; i++) {
        item = document.getElementsByClassName("result-card")[i];
        item.style.display = 'flex';
    }

    count += 1;
}

function showPrevSearch() {
    for(let i = 5*count; i < 5*(count+1); i++) {
        item = document.getElementsByClassName("result-card")[i];
        item.style.display = 'none';
    }
    for(let i = 5*(count-1); i < 5*count; i++) {
        item = document.getElementsByClassName("result-card")[i];
        item.style.display = 'flex';
    }

    count -= 1;
}