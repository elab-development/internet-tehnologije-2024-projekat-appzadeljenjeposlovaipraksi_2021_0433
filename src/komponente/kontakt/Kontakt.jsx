import React from 'react'
import Forma from './Forma'
import './Kontakt.css'

function Kontakt() {
  const str='K';
  return (
    <div className='kontakt-str'>
        <div className='kontakt-str-forma'>
        <h2>Imate pitanje za nas, sugestiju ili kritiku?</h2>
        <h3>Kontaktirajte nas</h3>
        <Forma str={str}/>
        </div>
       
    </div>
  )
}

export default Kontakt
