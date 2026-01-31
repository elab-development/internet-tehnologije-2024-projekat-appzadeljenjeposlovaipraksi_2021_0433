import React from 'react'
import './Naslov.css'

function Naslov({podnaslov, naslov}) {
  return (
    <div className='title'>
        <p>{podnaslov}</p>
        <h2>{naslov}</h2>
    </div>
  )
}

export default Naslov