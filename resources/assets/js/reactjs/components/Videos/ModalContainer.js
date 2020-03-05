import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';

/** function: ModalContainer */
class ModalContainer extends Component {
    constructor(props) {
        super(props);
        this.banner = '';
        this.eventArray = [];
        this.resultsContainer = '#video-results';

        this.state = {
            loading: false,
            src: '',
            header: ''
        };

        this.token = jQuery('meta[name="csrf-token"]').attr('content');

        this.axios_instance = axios.create();
        delete this.axios_instance.defaults.headers.common['X-CSRF-TOKEN'];

        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };

    }

    componentDidMount() {
        console.log('[Component Did Mount]', 'I mounted');
        this.setState({
            src: this.props.src,
            header: this.props.header
        });
    }

    render() {
        const { loading } = this.state;
        if(loading) { // if your component doesn't have to wait for an async action, remove this block
            return null; // render null when app is not ready
        }

        const style = {
            header: {
                textAlign: "center"
            },
            iframe: {
                height: '60vh'
            }
        };

        return (
            <div>
                <div className="modal fade" id="exampleModal" tabIndex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg h-100 d-flex flex-column justify-content-center my-0" role="document">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="exampleModalLabel" style={style.header}>{this.props.header}</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body">
                                <iframe src={this.props.src} style={style.iframe} width="100%" frameBorder="0"
                                        webkitallowfullscreen mozallowfullscreen allowFullScreen></iframe>
                            </div>
                            <div className="modal-footer">
                                <button type="button" className="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

ModalContainer.propTypes = {
    header: PropTypes.string.isRequired,
    src: PropTypes.string.isRequired
};

ModalContainer.defaultProps = {
    header: '',
    src: ''
};

export default ModalContainer;

if (document.getElementById('modal-container')) {
    render(
        <ModalContainer />,
        document.getElementById('modal-container')
    );
}