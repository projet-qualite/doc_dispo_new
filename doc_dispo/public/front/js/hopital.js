let specialites_hopital = document.querySelector('#specialites-hopital')
let specialites_medecin= document.querySelector('#specialites-medecin')
let btn_choix_medecin = document.querySelector('#choix-medecin-btn')
let listMedecin = document.querySelector('#list-medecins-choix')
 
document.querySelector('body').addEventListener('click', function(e){

    if(e.target.id === 'specialites-hopital')
    {
        specialites_medecin.style.display = 'block'
        let medecins = listMedecin.getElementsByClassName('medecin-spe')
        for(let i = 0 ; i < medecins.length; i++)
        {
            let specialites = medecins[i].getElementsByClassName('specialite-of-medecin')
            for(let j = 0 ; j < specialites.length ; j++)
            {
                if(specialites[j].textContent.trim() === specialites_hopital.value)
                {
                    medecins[i].style.display = 'block'
                }
    

            }
        }
    }

    btn_choix_medecin.addEventListener('click', function(){
        listMedecin.classList.toggle('list-medecin-invisible')
    })
    
    
    listMedecin.addEventListener('click', function(e){
        let parent = e.target.parentNode
        parent.classList.toggle('medecin-selected')
    })



    

   
})

let rdvs = 
document.querySelector('#rdvs').addEventListener('click', function(){
        
})

