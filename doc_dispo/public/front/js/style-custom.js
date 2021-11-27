let input = document.getElementsByClassName('search-query')[0]
let results = document.getElementsByClassName('resultElement')



if(typeof input !== 'undefined')
{
    input.addEventListener('keyup', function(e){
        document.getElementsByClassName('result')[0].style.display = 'block'
        let inputValue = input.value.toUpperCase();
        for(let i = 0; i < results.length; i++)
        {
            let l1 = results[i].getElementsByTagName('small')[0].textContent.toUpperCase();
            let l2 = results[i].getElementsByTagName('small')[1].textContent.toUpperCase();
    
            if(l1.indexOf(inputValue) > -1 || l2.indexOf(inputValue) > -1)
            {
                results[i].style.display = ""
            }
            else{
                results[i].style.display = "none"
    
            }
        }
        if(inputValue === '')
        {
            document.getElementsByClassName('result')[0].style.display = 'none'
        }
    
    })
}


 



var dayValpiere;

var listeUL1 = document.getElementsByClassName('time_select')[0]
var listeUL2 = document.getElementsByClassName('time_select')[1]


var creneau = document.getElementById('creneau')


let map = new Map()
map.set('Janvier', '01')
map.set('Fevrier', '02')
map.set('Mars', '03')
map.set('Avril', '04')
map.set('Mai', '05')
map.set('Juin', '06')
map.set('Juillet', '07')
map.set('Août', '08')
map.set('Septembre', '09')
map.set('Octobre', '10')
map.set('Novembre', '11')
map.set('Décembre', '12')

console.log(document.getElementsByClassName('datepicker-days')[0])

if(typeof document.getElementsByClassName('datepicker-days')[0] != 'undefined')
{
    let mois = document.getElementsByClassName('datepicker-days')[0]
            .getElementsByTagName('thead')[0].getElementsByTagName('tr')[1]
            .getElementsByTagName('th')[1].textContent.split(' ')[0]
}

if(typeof document.getElementsByClassName('datepicker-days')[0] != 'undefined')
{
    let annee = document.getElementsByClassName('datepicker-days')[0]
            .getElementsByTagName('thead')[0].getElementsByTagName('tr')[1]
            .getElementsByTagName('th')[1].textContent.split(' ')[1]
}



