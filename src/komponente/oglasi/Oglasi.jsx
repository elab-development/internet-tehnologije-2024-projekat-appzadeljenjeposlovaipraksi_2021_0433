import React from 'react'
import Stavka from '../stavka/Stavka'
import './Oglasi.css'

function Oglasi() {

  const str = 'O';
  return (
    <div className="oglasi-stranica">
      <div className="lista-oglasa">
        <Stavka stranica={str}/>
        <Stavka stranica={str}/>
        <Stavka stranica={str}/>
        <Stavka stranica={str}/>
        <Stavka stranica={str}/>
        <Stavka stranica={str}/>
        <Stavka stranica={str}/>
        <Stavka stranica={str}/>
        
      </div>
    </div>
  );
}



export default Oglasi