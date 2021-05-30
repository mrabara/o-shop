import React from 'react'
import '../../css/card-list.styles.css'
import { Card } from '../card/Card';

export const CardList = ({monsters}) => {
    return (
        
        <div className='card-list'>
            {
                monsters.map(monster => <Card key={monster.id} monster={ monster}/>)
            }
        </div>
    )
}
