import React, { useEffect, useState } from 'react'
import './Detalji.css'
import Stavka from '../stavka/Stavka'
import Dugme from '../dugme/Dugme'
import Forma from '../kontakt/Forma';
import { collection, getDocs } from 'firebase/firestore';
import { db } from '../../firebase';
import { useParams } from 'react-router-dom';

export function useOglas(nizOglasa) {
  const { id } = useParams();
  const [tOglas, setTOglas] = useState(null);

  useEffect(() => {
    const trenutniOglas = nizOglasa.find(oglas => oglas.id === id);
    setTOglas(trenutniOglas);
  }, [id, nizOglasa]);

  return tOglas;
}
export function useKompanija(nizKomp) {
  const { id } = useParams();
  const [tKomp, setTKomp] = useState(null);

  useEffect(() => {
    
      const trenutnaKomp = nizKomp.find(k => k.id === id);
      setTKomp(trenutnaKomp);
    
  }, [id, nizKomp]);

  return tKomp;
}

function Detalji({str}) {


    const[modalOpen, setModalOpen]=useState(false);
    const otvoriModal = ()=>setModalOpen(true);
    const zatvoriModal = ()=> setModalOpen(false);
    const[nizKomp , setNizKomp] = useState([])
    const[nizOglasa , setNizOglasa] = useState([])

    const refO=collection(db,"oglasi");
    const refK=collection(db,"kompanije");

    async function getNizOglasa() {
        const snapshot = await getDocs(refO);
        const items = [];
        
        snapshot.docs.forEach(function (doc){
            const podatak = doc.data();
            podatak.id =doc.id;
            items.push(podatak);
        })

        setNizOglasa(items);
    }

    async function getNizKomp() {

       const snapshot = await getDocs(refK);
       const items=[];

       snapshot.docs.forEach(function (doc){

        const podatak = doc.data();
        podatak.id = doc.id;
        items.push(podatak);
       })

       setNizKomp(items);

    }
    useEffect(() =>  {
        getNizKomp();
        getNizOglasa();
    },[]);

    const tOglas = useOglas(nizOglasa);
    const tKomp = useKompanija(nizKomp);
    
if (str === 'O' && !tOglas) {
    return <p>Učitavanje oglasa...</p>;
  }

  if (str !== 'O' && !tKomp) {
    return <p>Učitavanje kompanije...</p>;
  }

 

  return (
    <div className='detalji'>
        
        {str==='O' && tOglas ? 
        <>
        <div className="zaglavlje">
            <img src={tOglas.logo} alt="" />
            <div className="naziv">
                <h2>{tOglas.kompanija}</h2>
                <h3>{tOglas.grad}</h3>
            </div>
        </div>
         <div className="telo">
            <div className="pozicija">
                <h3>Naziv pozicije</h3>
                <p>{tOglas.pozicija}</p>
            </div>
            <div className="oglas-opis">
                <h3>Opis oglasa</h3>
                <p>{tOglas.opis}</p>
            </div>
            <div className='dugme' onClick={otvoriModal}>
                <Dugme tekst='Prijavi se'/>
            </div>
            </div>
            </>  : <></>}
            {str !=='O' && tKomp ? 
            <>
            <div className="zaglavlje">
            <img src={tKomp.logo} alt="" />
            <div className="naziv">
                <h2>{tKomp.naziv}</h2>
                <h3>{tKomp.mesto}</h3>
            </div>
        </div>
                <div className="telo">
            <div className="pozicija">
                <h3>Naziv kompanije</h3>
                <p>{tKomp.naziv}</p>
            </div>
            <div className="oglas-opis">
                <h3>Opis kompanije</h3>
                <p>{tKomp.opis}</p>
            </div>
            <div className='ogl'>
            <Stavka stranica={'O'}/>
            <Stavka stranica={'O'}/>
            <Stavka stranica={'O'}/>
            <Stavka stranica={'O'}/>

             </div>
          
            </div>
            </>: <></>}

            {modalOpen && (
                <div className="modal-overlay" onClick={zatvoriModal}>
                    <div className="modal-content" onClick={(e) => e.stopPropagation()}>
                        <button className='zatvori' onClick={zatvoriModal}>X</button>
                        <Forma/>
                    </div>
                </div>
            )}
    
        </div>
    
  )
}

export default Detalji