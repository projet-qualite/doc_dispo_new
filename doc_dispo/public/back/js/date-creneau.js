let selected = document.querySelector('#select-dates')
let rdvs = document.querySelectorAll('.rdvs')

selected.addEventListener('change', function(){
    if(selected.value === 'all')
    {
        for(let i = 0 ; i < rdvs.length; i++)
        {
            rdvs[i].style.display = 'block'
        }
    }

    if(selected.value === 'next')
    {
     
        let day1 = new Date().getTime()
        for(let i = 0 ; i < rdvs.length; i++)
        {
            console.log("nnnn")
           let day2 = new Date(rdvs[i].querySelector('#date_creneau_rdv').textContent).getTime();
           console.log(day2)

           if(day1 < day2)
           {
            rdvs[i].style.display = 'block'
           }
           else{
            rdvs[i].style.display = 'none'
           }
        }
    }

    if(selected.value === 'today')
    {
        let day1 = new Date().getTime()
        for(let i = 0 ; i < rdvs.length; i++)
        {
           let day2 = new Date(rdvs[i].querySelector('#date_creneau_rdv').textContent).getTime();

           if(day1 === day2)
           {
            rdvs[i].style.display = 'block'
           }
           else{
            rdvs[i].style.display = 'none'
           }
        }
    }

    if(selected.value === 'next')
    {
        let day1 = new Date().getTime()
        for(let i = 0 ; i < rdvs.selected; i++)
        {
           let day2 = new Date(rdvs[i].querySelector('#date_creneau_rdv').textContent).getTime();

           if(day1 > day2)
           {
            rdvs[i].style.display = 'block'
           }
           else{
            rdvs[i].style.display = 'none'
           }
        }
    }

})