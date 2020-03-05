import React, {Component} from 'react';
import PropTypes from 'prop-types';
import reactCSS from 'reactcss';

/** class SketchInLine */
class SketchInLine extends Component {
    constructor(props) {
        super(props);
        this.state = {
            displayColorPicker: false,
            color: {
                r: '241',
                g: '112',
                b: '19',
                a: '1',
            },
        };
        this.basicStyle = {
            inline: {
                display: 'inline-block'
            }
        }
    }

    componentDidMount() {
        console.log("Component Did Mount");
        // debugger;
        let newState = Object.assign({}, this.state);
        newState.color = this.props.color;
        this.setState(newState);
    }

    render() {

        const styles = reactCSS({
            'default': {
                color: {
                    width: '36px',
                    height: '14px',
                    borderRadius: '2px',
                    background: `rgba(${ this.props.color.r }, ${ this.props.color.g }, ${ this.props.color.b }, ${ this.props.color.a })`,
                    display: 'inline-block',
                    marginRight: '4px'
                },
                swatch: {
                    padding: '5px',
                    background: '#fff',
                    borderRadius: '1px',
                    boxShadow: '0 0 0 1px rgba(0,0,0,.1)',
                    display: 'inline-block',
                    cursor: 'pointer',
                },
                popover: {
                    position: 'absolute',
                    zIndex: '2',
                },
                cover: {
                    position: 'fixed',
                    top: '0px',
                    right: '0px',
                    bottom: '0px',
                    left: '0px',
                },
            },
        });

        return (
            <div style={ styles.color } />
        )
    }
}

SketchInLine.propTypes = {
    /** Input name. Unique HTML ID. Recommend setting this to match object's property so a single change handler can */
    name: PropTypes.string.isRequired,
    color: PropTypes.object.isRequired
};

SketchInLine.defaultProps = {
    //myProp: val
};

export default SketchInLine;