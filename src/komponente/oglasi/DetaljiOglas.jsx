import React from 'react'
import Detalji from '../detalji/Detalji'
import './DetaljiOglas.css'

function DetaljiOglas() {
  let str='O'
  return (
    <div className='detaljiOglas'>
      <div>
        <Detalji str={str}/>
      </div>
    </div>
  )
}

export default DetaljiOglas