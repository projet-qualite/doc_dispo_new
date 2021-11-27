let dayOfMonth = document.getElementsByClassName('datepicker-days')[0].
                            getElementsByClassName('table-condensed')[0]
                            .getElementsByTagName('tbody')[0]
                            .getElementsByClassName('day')

dayOfMonth.addEventListener('click', function(){
    console.log("YOO")
})
