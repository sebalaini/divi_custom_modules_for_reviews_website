import React, { Component, Fragment } from 'react';
import Button from '../../fields/Button/Button';
import List from '../../fields/List/List';
import Rating from '../../fields/Rating/Rating';
import Star from '../../fields/Star/Star';
import Text from '../../fields/Text/Text';

class Attributes extends Component {
	static slug = 'poca_post_custom_attributes_item';

	state = {};

	componentDidMount() {
		this.setState({
			type: this.switch(this.props.attribute_type),
		});
	}

	switch = (str) =>
		({
			button: (
				<Button
					name={this.props.attribute_text}
					color={this.props.button_color}
				/>
			),
			list: <List />,
			rating: (
				<Rating
					name={this.props.attribute_text}
					color={this.props.rating_color}
				/>
			),
			title: <Star />,
			text: <Text name={this.props.attribute_text} />,
		}[str]);

	render() {
		return <Fragment>{this.state.type}</Fragment>;
	}
}

export default Attributes;
