import React, { Component, Fragment } from 'react';

import './style.css';

class Container extends Component {
	static slug = 'poca_post_custom_attributes';

	render() {
		let header = null;

		if (this.props.toggle_header === 'on') {
			header = <h2 className='poca-custom-header'>{this.props.header}</h2>;
		}

		return (
			<Fragment>
				{header}
				<div className='poca-post-custom-attributes'>{this.props.content}</div>
			</Fragment>
		);
	}
}

export default Container;
