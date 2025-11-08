import React from 'react'
import './Dugme.css'

function Dugme({tekst}) {
    /*let tekst="Sacuvaj";*/
   // let akcija=nekaAkcija();
  return (
    <button className='btn'>
        {tekst}
    </button>
  )
}

export default Dugme