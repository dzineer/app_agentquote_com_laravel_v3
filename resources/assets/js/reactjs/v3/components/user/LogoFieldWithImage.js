import React, { Component } from 'react';
import PropTypes from 'prop-types';
import ReactDom from "react-dom";
import toastr from 'toastr';

/** class: LogoFieldWithImage */
class LogoFieldWithImage extends Component {

    constructor(props) {
        super(props);
    }

    render() {

        const css = {
            for: {
                fileInput: {
                    display: "inline-block"
                },
                note: {
                    "fontStyle": "italic",
                    "fontSize": "0.9rem"
                },
                image: {
                    display: "block"
                },
                logo: {
                    for: {
                        image: {
                            maxWidth: this.props.dimensions.width,
                            maxHeight: this.props.dimensions.height,
                        }
                    }
                }
            }
        };

        return (
            <div className="form-group">
                <div className="field">
                    { this.props.error && (
                        <div className="alert alert-danger" role="alert">
                            {this.props.error}
                        </div>
                    )}
                    <label htmlFor={ this.props.name } style={css.for.image}>{ this.props.label }</label>
                    <p style={ css.for.note }>{ this.props.note }</p>
                    { this.props.using && (
                        <div className="d-flex align-items-center">
                            <img name={ this.props.name } src={ this.props.path } style={css.for.logo.for.image} />
                            { this.props.using && <a href="" className="m-l-6" onClick={ this.props.onRemoveImage } style={{ "cursor":"pointer", "textDecoration":"initial" }} alt="Remove" title="Remove" data-toggle="tooltip" data-html="true">
                                <i className="fa fa-times" style={{ "fontSize": "1.2rem", "color": "#dd4b39"}} />
                            </a> }
                        </div>
                    ) }
                    <input id={ this.props.name } name={ this.props.name } type="file" className="form-control-file" style={ css.for.fileInput } onChange={ this.props.onChange } />
                </div>
            </div>
        );
    }
}

LogoFieldWithImage.propTypes = {
    name: PropTypes.string,
    error: PropTypes.string,
    label: PropTypes.string,
    dimensions: PropTypes.object,
    onChange: PropTypes.func.isRequired,
    onRemoveImage: PropTypes.func.isRequired,
    using: PropTypes.bool.isRequired,
    note: PropTypes.string
};

LogoFieldWithImage.defaultProps = {
    name: "",
    error: "",
    label: "Image",
    dimensions: { height: '100px', 'width': '100px' },
    onChange: () => {},
    onRemoveImage: () => {},
    using: false,
    note: ''
};

export default LogoFieldWithImage;

if (document.getElementById('logo-field-with-image')) {
    ReactDom.render(<LogoFieldWithImage />,
        document.getElementById('logo-field-with-image')
    );
}
