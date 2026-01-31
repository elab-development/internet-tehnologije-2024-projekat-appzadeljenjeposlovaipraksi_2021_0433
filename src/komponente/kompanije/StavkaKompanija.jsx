import React, { useEffect, useState } from 'react'
import logo1 from '../../assets/lidl.png'
import './StavkaKompanije.css'
import { useNavigate } from 'react-router-dom';
import { IoLocationOutline } from "react-icons/io5";
import { collection, getDocs } from 'firebase/firestore';
import { db } from '../../firebase';


function StavkaKompanija() {

  const [nizKomp, setNizKomp]=useState([])

  const ref=collection(db,"kompanije")

  async function getNizKomp() {

    
      const snapshot = await getDocs(ref);
      const items = [];
    
      snapshot.docs.forEach(function(doc) {
        const podatak = doc.data();
        podatak.id = doc.id;
        items.push(podatak);
      });
    
      setNizKomp(items);
      
    
  }
  useEffect(() =>{

    getNizKomp();
  }, [])

   const navigate=useNavigate()
   const otvoriKomp = (komp)=>{
      navigate(`/detaljiKompanija/${komp.id}`);
  }
function getStanje(nazivKomp){
  return 3;
}


  return(

    <>
    {nizKomp.map((komp) =>{
      let nazivKomp=komp.naziv;
      let lokacija=komp.mesto;
      let stanje= getStanje(komp.naziv);
      let id=komp.id;
      let logo=komp.logo
    
 return (
    <div className='KStavka' onClick={() => otvoriKomp(komp)}>
        <img src={logo} alt="" />
         <div className="overlay">
         <h3>Prikaži detalje o kompaniji</h3> 
         </div>
         <div  className="komp-detalji">
                <div className="naziv">
                <h1>{nazivKomp}</h1>
                </div>
             <label>
                <div className="lokacija">
                <IoLocationOutline />
                <h2>{lokacija}</h2>
                </div>
            </label>
          
        </div>
        <div className="stanje">
                <h3>Trenutno aktivno oglasa:{stanje}</h3>
              </div>
        
        
    </div>
  )
    
    
    })}
   
    
  
  

   

  
  </>
)
}

export default StavkaKompanija