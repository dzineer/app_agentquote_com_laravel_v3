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
                disclaimer: {
                    "fontStyle": "italic",
                    "fontSize": "0.9rem"
                },
                portrait: {
                    display: "block"
                },
                logo: {
                    for: {
                        image: {
                            width: "168px", maxWidth: '100%'
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
                    <label htmlFor="logo" style={css.for.portrait}>{ this.props.label }</label>
                    <p style={css.for.disclaimer}>{ this.props.disclaimer }</p>
                    { this.props.path && (
                        <div className="d-flex align-items-center">
                            <img name="profile-logo" src={ this.props.path } style={css.for.logo.for.image} alt='[Website Logo]' />
                            { this.props.using && <a href="" className="m-l-6" onClick={ this.props.onRemoveLogo } style={{ "cursor":"pointer", "textDecoration":"initial" }} alt="Remove Logo" title="Remove Logo" data-toggle="tooltip" data-html="true">
                                <i className="fa fa-times" style={{ "fontSize": "1.2rem", "color": "#dd4b39"}} />
                            </a> }
                        </div>
                    ) }
                    <input id="logo" name="logo" type="file" className="form-control-file" style={css.for.fileInput} onChange={this.props.onChange} />
                </div>
            </div>
        );
    }
}

LogoFieldWithImage.propTypes = {
    error: PropTypes.string,
    label: PropTypes.string,
    onChange: PropTypes.func.isRequired,
    onRemoveLogo: PropTypes.func.isRequired,
    using: PropTypes.bool.isRequired,
    disclaimer: PropTypes.string
};

LogoFieldWithImage.defaultProps = {
    error: "",
    label: "Image",
    onChange: () => {},
    onRemoveLogo: () => {},
    using: false,
    disclaimer: ''
};

export default LogoFieldWithImage;

if (document.getElementById('logo-field-with-image')) {
    ReactDom.render(<LogoFieldWithImage />,
        document.getElementById('logo-field-with-image')
    );
}
