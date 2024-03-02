import React, { Component } from 'react';
import './style.css';

class List extends Component {
	static slug = 'poca_product_rating-list';

	render() {
		const noIcon = (
			<svg
				viewBox='4 4 12 12'
				width='20px'
				fill='#DE668B'
				xmlns='http://www.w3.org/2000/svg'
			>
				<path d='m14.348 14.849c-.469.469-1.229.469-1.697 0l-2.651-3.03-2.651 3.029c-.469.469-1.229.469-1.697 0-.469-.469-.469-1.229 0-1.697l2.758-3.15-2.759-3.152c-.469-.469-.469-1.228 0-1.697s1.228-.469 1.697 0l2.652 3.031 2.651-3.031c.469-.469 1.228-.469 1.697 0s.469 1.229 0 1.697l-2.758 3.152 2.758 3.15c.469.469.469 1.229 0 1.698z' />
			</svg>
		);
		const yesIcon = (
			<svg
				viewBox='2 2 16 16'
				width='20px'
				fill='#66DEB9'
				xmlns='http://www.w3.org/2000/svg'
			>
				<path d='m8.294 16.998c-.435 0-.847-.203-1.111-.553l-3.573-4.721c-.465-.613-.344-1.486.27-1.951.615-.467 1.488-.344 1.953.27l2.351 3.104 5.911-9.492c.407-.652 1.267-.852 1.921-.445.653.406.854 1.266.446 1.92l-6.984 11.21c-.242.391-.661.635-1.12.656-.022.002-.042.002-.064.002z' />
			</svg>
		);

		return (
			<div className='poca-hotel-review-list-wrapper'>
				<div>
					<p className='poca-fonts poca-bold'>Pros:</p>
					<ul>
						<li>{yesIcon} Zona de juego</li>
						<li>{yesIcon} Mini Club</li>
						<li>{yesIcon} SPA</li>
					</ul>
				</div>

				<div>
					<p className='poca-fonts poca-bold'>Contras:</p>
					<ul>
						<li>{noIcon} Parque de bolas</li>
						<li>{noIcon} Tobogán</li>
						<li>{noIcon} Mini golf</li>
					</ul>
				</div>
			</div>
		);
	}
}

export default List;
