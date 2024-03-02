import React, { Component } from 'react';
import './style.css';

class Rating extends Component {
	static slug = 'poca_hotel_rating_rate';

	render() {
		return (
			<div className='poca-hotel-rating'>
				<p className='poca-fonts poca-h3'>{this.props.name}</p>

				<div className='poca-hotel-rating-rate-wrapper'>
					<div className={`poca-hotel-rating-rate ${this.props.color}`}>
						4<span>/10</span>
					</div>
				</div>
			</div>
		);
	}
}

export default Rating;
