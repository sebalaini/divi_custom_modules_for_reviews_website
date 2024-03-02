// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';

class Text extends Component {
	static slug = 'poca_product_rating-text';

	render() {
		return (
			<div className='poca-product-text'>
				<p className='poca-fonts poca-h3'>{this.props.name}</p>
				<p className='poca-fonts poca-h4 poca-bold'>Some Value</p>
			</div>
		);
	}
}

export default Text;
