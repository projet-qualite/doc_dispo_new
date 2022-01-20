/*
Récupérer les jours d'un mois
 */
function getDays(month, year, initialize = true)
{

    let daysInMonth = new Date(year, month, 0).getDate();
    let days = []
    let week = 1;



    for(let i = 1; i <= daysInMonth; i++)
    {
        let dayLabel = new Date(year, month-1, i).getDay()
        let selected = false
        let heures = []

        if(initialize)
        {
            for(let j = 0; j < creneaux.length ; j++)
            {
                let d = new Date(creneaux[j].jour)

                if(d.getTime() === new Date(year, month-1, i, 1,0).getTime())
                {
                    if(creneaux[j].id_motif_consult === 0)
                    {
                        selected = true
                    }
                    else{

                        if(specialites_medecin.value == creneaux[j].id_motif_consult)
                        {
                            selected = true
                        }
                    }


                    heures.push(creneaux[j].heure)

                }
            }
        }
        days.push({
            'day': i,
            'dayLabel': dayLabel,
            'week': week,
            'selected': selected,
            'heures': heures
        })

        if(dayLabel ===0)
        {
            week++
        }
        selected = false
        heures = []

    }

    return days;
}




function hoursOfDay(day)
{
    let heures = []
    for(let i = 0; i < creneaux.length; i++)
    {
        if(creneaux[i].jour === day)
        {
            heures.push(
                {
                    'id': creneaux[i].id,
                    'heure': creneaux[i].heure
                }

                )
        }
    }

    heures.sort((a,b) => {
        if( parseFloat(a.heure) < parseFloat(b.heure) )
        {
            return -1
        }
        if(parseFloat(a.heure) > parseFloat(b.heure) )
        {
            return 1
        }

        return 0
    })

    return heures
}



function dayOfCreneau(){

    let date1 = creneaux[0].date_creneau
    let jour = date1.split('-')[2]
    let mois = date1.split('-')[1] - 1
    let annee = date1.split('-')[0]

    let temps1 = creneaux[0].heure_creneau
    let heure = temps1.split('.')[0]
    let minute = temps1.split('.')[1]


    let minDate = new Date(annee, mois, jour, heure, minute)
    for(let i = 1; i < creneaux.length ; i++)
    {
        let date2 = creneaux[i].date_creneau
        let jour = date2.split('-')[2]
        let mois = date2.split('-')[1] - 1
        let annee = date2.split('-')[0]

        let temps2 = creneaux[i].heure_creneau
        let heure = temps2.split('.')[0]
        let minute = temps2.split('.')[1]

        let d2 = new Date(annee, mois, jour, heure, minute)

        if(minDate.getTime() > d2.getTime())
        {
            minDate = d2
        }
    }

    return minDate
}
let specialites_medecin = document.getElementById('motifs-du-medecin')
let creneau_input = document.getElementById('id_creneau')


var months = new Map();
months.set('Janvier', 01)
months.set('Fevrier', 02)
months.set('Mars', 03)
months.set('Avril', 04)
months.set('Mai', 05)
months.set('Juin', 06)
months.set('Juillet', 07)
months.set('Août', 08)
months.set('Septembre', 09)
months.set('Octobre', 10)
months.set('Novembre', 11)
months.set('Décembre', 12)



var months2 = new Map();
months2.set('Janvier', '01')
months2.set('Fevrier', '02')
months2.set('Mars', '03')
months2.set('Avril', '04')
months2.set('Mai', '05')
months2.set('Juin', '06')
months2.set('Juillet', '07')
months2.set('Août', '08')
months2.set('Septembre', '09')
months2.set('Octobre', '10')
months2.set('Novembre', '11')
months2.set('Décembre', '12')


var numberToMonth = new Map();
numberToMonth.set(1,'Janvier')
numberToMonth.set(2,'Fevrier')
numberToMonth.set(3,'Mars')
numberToMonth.set(4,'Avril')
numberToMonth.set(5,'Mai')
numberToMonth.set(6,'Juin')
numberToMonth.set(7,'Juillet')
numberToMonth.set(8,'Août')
numberToMonth.set(9,'Septembre')
numberToMonth.set(10,'Octobre')
numberToMonth.set(11,'Novembre')
numberToMonth.set(12,'Décembre')




var carToMonth = new Map();
carToMonth.set('01','Janvier')
carToMonth.set('02','Fevrier')
carToMonth.set('03','Mars')
carToMonth.set('04','Avril')
carToMonth.set('05','Mai')
carToMonth.set('06','Juin')
carToMonth.set('07','Juillet')
carToMonth.set('08','Août')
carToMonth.set('09','Septembre')
carToMonth.set('10','Octobre')
carToMonth.set('11','Novembre')
carToMonth.set('12','Décembre')

var daysWeek = new Map()
daysWeek.set(1, 'Lundi')
daysWeek.set(2, 'Mardi')
daysWeek.set(3, 'Mercredi')
daysWeek.set(4, 'Jeudi')
daysWeek.set(5, 'Vendredi')
daysWeek.set(6, 'Samedi')
daysWeek.set(0, 'Dimanche')


let choice_month = document.getElementById('label-choice-month')
let list_choice_month = document.getElementsByClassName('choice-month-value')


var currentMonth = new Date().getMonth() +1

choice_month.textContent = numberToMonth.get(currentMonth)
var currentYear = new Date().getFullYear()
var days = getDays(currentMonth, currentYear, false)
var calendar = document.querySelector('#app-calendar')


function addDaysToCalendar(arrayDays)
{
    calendar.textContent = ''
    for(let i = 0; i < arrayDays.length; i++)
    {
        let day = arrayDays[i]
        let dayDiv = document.createElement('div')
        dayDiv.classList.add('day')
        if(day.selected)
        {
            dayDiv.classList.add('jour_disponible')
        }
        else{
            dayDiv.classList.add('jour_indisponible')
        }


        dayDiv.textContent = day.day
        dayDiv.style.gridRow = day.week
        dayDiv.style.gridColumn = (day.dayLabel === 0) ? 7 : day.dayLabel
        calendar.appendChild(dayDiv)
    }

}

addDaysToCalendar(days)




let btn_choice_month = document.getElementById('btn-choice-month')
let btn_choice_year = document.getElementById('btn-choice-year')


let div_choice_month = document.getElementById('choice-month-list-div')
let div_choice_year = document.getElementById('choice-year-list-div')


btn_choice_month.addEventListener('click', function(){
    div_choice_month.classList.toggle('isNotVisible')

    if(!(div_choice_month.classList.contains('isNotVisible')) )
    {
        div_choice_year.classList.add('isNotVisible')
    }


})


btn_choice_year.addEventListener('click', function(){
    div_choice_year.classList.toggle('isNotVisible')

    if(!(div_choice_year.classList.contains('isNotVisible')) )
    {
        div_choice_month.classList.add('isNotVisible')
    }
})



let choice_year = document.getElementById('label-choice-year')
let list_choice_year = document.getElementsByClassName('choice-year-value')
var jour_disponible = document.querySelectorAll('.jour_disponible')


for(let i = 0; i < list_choice_year.length; i++)
{
    let li = list_choice_year[i]
    li.addEventListener('click', function(){
        choice_year.textContent = li.textContent
        div_choice_year.classList.toggle('isNotVisible')
        currentMonth = months.get(choice_month.textContent)
        currentYear = choice_year.textContent

        calendar.textContent = ''
        days = getDays(currentMonth, currentYear)
        addDaysToCalendar(days)
        jour_disponible = document.querySelectorAll('.jour_disponible')


    })
}






for(let i = 0; i < list_choice_month.length; i++)
{
    let li = list_choice_month[i]
    li.addEventListener('click', function(){
        choice_month.textContent = li.textContent
        div_choice_month.classList.toggle('isNotVisible')

        currentMonth = months.get(choice_month.textContent)
        currentYear = choice_year.textContent

        calendar.textContent = ''

        days = getDays(currentMonth, currentYear)
        addDaysToCalendar(days)
        jour_disponible = document.querySelectorAll('.jour_disponible')
    })
}


let rdv_dispo = document.querySelector('#rdv_dispo_list')

document.querySelector('#app-calendar').addEventListener('mouseup', function(){
    for(let i = 0; i < jour_disponible.length; i++)
    {
        let li = jour_disponible[i]
        li.addEventListener('click', function(){
            rdv_dispo.textContent = ''
            console.log(li)

            let day = (li.textContent < 10) ? '0'+li.textContent : li.textContent
            let month = months2.get(choice_month.textContent)
            let year = choice_year.textContent

            let datee = year+'-'+month+'-'+day

            let d = new Date(datee).getDay()

            let li1 = document.createElement('li')
            li1.classList.add('rdv_libre_ctn')

            let p = document.createElement('p')
            p.classList.add('rdv_libre_entete')

            let span = document.createElement('span')
            span.classList.add('rdv_libre_entete_day')
            span.textContent = daysWeek.get(d)


            let span2 = document.createElement('span')
            span2.classList.add('rdv_libre_entete_date')
            span2.textContent = day+' '+ choice_month.textContent+ ' '+ year

            p.appendChild(span)
            p.appendChild(span2)


            let div = document.createElement('div')
            let div2 = document.createElement('div')



            let hours = hoursOfDay(datee)
            let nb = 0

            for(let i = 0; i < hours.length; i++)
            {
                nb++;

                let a = document.createElement('a')
                a.classList.add('rdv_libre_horaire')
                a.textContent = hours[i].heure
                a.setAttribute('id_creneau', hours[i].id)
                a.setAttribute('href', '#patient')
                a.addEventListener('click', function(event){
                    retiredStyle(a)
                    a.classList.toggle('heure-selected')

                    if(a.classList.contains('heure-selected'))
                    {
                        try{
                            creneau_input.setAttribute("value", a.getAttribute('id_creneau'))
                        }catch(e)
                        {
                            document.getElementById('message').textContent = "Veuillez vous connecter en tant que patient pour pouvoir prendre un rendez-vous"
                            //window.location.replace("/connexion")
                        }
                    }

                 })




                 if(nb )

                 if(nb%6 !== 0)
                 {
                    div2.appendChild(a)
                 }
                 else{
                    div.appendChild(div2)
                    div2 = document.createElement('div')
                    nb = 0
                 }



            }
            div.appendChild(div2)
            li1.appendChild(p)
            li1.appendChild(div)


            rdv_dispo.appendChild(li1)



        })
    }


})




specialites_medecin.addEventListener('change', function(){
    currentYear = new Date().getFullYear()
    currentMonth = new Date().getMonth() +1
    choice_month.textContent = numberToMonth.get(currentMonth)
    choice_year.textContent = currentYear
    var days = getDays(currentMonth, currentYear)
    addDaysToCalendar(days)

    let far = farDate(specialites_medecin.value)
    if(far.length > 0)
    {
        let date_far = far[0].jour
        let month = date_far.split('-')[1]
        let annee = date_far.split('-')[0]
        var days = getDays(month, annee)
        addDaysToCalendar(days)
        choice_month.textContent = carToMonth.get(month)
        choice_year.textContent = annee

        jour_disponible = document.querySelectorAll('.jour_disponible')
    }

})


function farDate(specialiteSelected)
{
    let p = []
    for(let i = 0 ; i < creneaux.length ; i++)
    {
        if(creneaux[i].id_motif_consult === 0)
        {
            p.push(creneaux[i])
        }
        else{
            if(creneaux[i].id_motif_consult == specialiteSelected)
            {
                p.push(creneaux[i])
            }
        }
    }

    return p
}


function retiredStyle(a)
{
    let a_selected = document.getElementsByClassName('heure-selected')

    for(let element of a_selected)
    {
        if(element !== a)
        {
            element.classList.remove("heure-selected")
        }
    }
}
