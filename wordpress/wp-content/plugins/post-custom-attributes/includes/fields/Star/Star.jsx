import React, { Component } from 'react';
import './style.css';

class Star extends Component {
	static slug = 'poca_hotel_rating_star';

	render() {
		const stars = [...Array(2).keys()];

		return (
			<h1>
				<div className='poca-hotel-rating-star'>
					{stars.map((index) => (
						<svg
							xmlns='http://www.w3.org/2000/svg'
							height='25px'
							viewBox='0 0 576 512'
							fill='#fa5636'
							key={index}
						>
							<path d='M259.3 17.8 194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z' />
						</svg>
					))}
				</div>
				Hotel name
			</h1>
		);
	}
}

export default Star;
