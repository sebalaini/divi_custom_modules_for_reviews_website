// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';

class Button extends Component {
	static slug = 'poca_product_rating-button';

	render() {
		return (
			<a
				className={`poca-product-button ${this.props.color}`}
				href='https://www.booking.com'
			>
				{this.props.name}
			</a>
		);
	}
}

export default Button;
