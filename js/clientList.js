function changeClientType(val){
  if(val==0){
    document.getElementById('ClientNameLabel').innerHTML='ФИО';
    document.getElementById('newLegalAddress').value='';
    document.getElementById('newLegalAddress').disabled=true;
  } else {
    document.getElementById('ClientNameLabel').innerHTML='Наименование';
    document.getElementById('newLegalAddress').disabled=false;
  }
}

// function getDetailOnClient(id){
//   document.location.href = "index.php";
// }

//==============INPUT MASK================================
$(function(){
  // Получить элемент, к которому необходимо добавить маску
  // $("#phone").mask("+7(999) 999-9999");
  $("#newPhone").mask("+7(999) 999-9999");
  $("#newInn").mask("999999999999");
  $("#newKpp").mask("999999999");
  $("#newBic").mask("999999999");
  $("#newAcc").mask("99999999999999999999");
  $("#newCorr").mask("99999999999999999999");
});
//==================END





//===============SORT TABLE================================
document.addEventListener('DOMContentLoaded', () => {

    const getSort = ({ target }) => {
        const order = (target.dataset.order = -(target.dataset.order || -1));
        const index = [...target.parentNode.cells].indexOf(target);
        const collator = new Intl.Collator(['en', 'ru'], { numeric: true });
        const comparator = (index, order) => (a, b) => order * collator.compare(
            a.children[index].innerHTML,
            b.children[index].innerHTML
        );
        
        for(const tBody of target.closest('table').tBodies)
            tBody.append(...[...tBody.rows].sort(comparator(index, order)));

        for(const cell of target.parentNode.cells)
            cell.classList.toggle('sorted', cell === target);
    };
    
    document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));
});
//==================END



//==============================================================================================================
$.fn.setCursorPosition = function(pos) {
  if ($(this).get(0).setSelectionRange) {
    $(this).get(0).setSelectionRange(pos, pos);
  } else if ($(this).get(0).createTextRange) {
    var range = $(this).get(0).createTextRange();
    range.collapse(true);
    range.moveEnd('character', pos);
    range.moveStart('character', pos);
    range.select();
  }
};
//=============================================================================================================================
$('input[type="tel"]').click(function(){
    $(this).setCursorPosition(3);  // set position number
  });