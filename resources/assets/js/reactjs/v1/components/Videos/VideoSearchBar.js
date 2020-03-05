import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import ModalContainer from "./ModalContainer";

/** function: VideoSearchBar */
class VideoSearchBar extends Component {
    constructor(props) {
        super(props);
        this.banner = '';
        this.eventArray = [];
        this.resultsContainer = '#video-results';

        this.state = {
            showModal: false
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

        this.onClick.bind(this);
        this.onChange.bind(this);
    }

    componentDidMount() {
        console.log('[Component Did Mount]', 'I mounted');
        this.setState({})
    }

    onClick(event, header, url) {
        console.log("url", url);
        this.setState({
            showModal: true
        });

        if (!$('#video-modal-container').length){
            $("<div id='video-modal-container'></div>").appendTo(document.body);
        }

        render(
            <ModalContainer header={header} src={url} />,
            document.getElementById('video-modal-container')
        );

        $('#exampleModal').modal('show');
    }

    onChange(event) {

    }

    render() {
        const { loading } = this.state;
        if(loading) { // if your component doesn't have to wait for an async action, remove this block
            return null; // render null when app is not ready
        }

        let styles = {
            searchHeader: {
                "textAlign": "center"
            },
            responsiveThumbnail: {
                'maxWidth': '100%',
                'cursor': 'pointer'
            },
            clickContainer: {
                'cursor': 'pointer'
            },
            searchContainer: {
                'width': '100%',
                'margin': '10px auto',
                'textAlign': 'center',
              //  'marginLeft': '35px'
            }
        };

        return (
            <div>

                <div className="row">

                    <div className="col-md-3" />

                    <div className="col-md-6">

                        <div className="" style={styles.searchHeader}>
                            <h2 className="header main-section-header">Welcome to My Mobile Life Quoter Videos</h2>
                            <p className="header main-section-sub-header">Check out the videos below for answers to some of our most common support questions.</p>
                        </div>

                        <div className="lighter">
                            <div style={styles.searchContainer}>
                                <input type="text" className="search rounded" placeholder="Search" onChange={this.props.onChange} />
                                {/*<span className="end-of-input-icon"><i className="fa fa-search fa-fw" /></span>*/}
                            </div>
                        </div>

                    </div>

                    <div className="col-md-3" />

                </div>

                <div className="row">

                    {  this.props.videos.map( video => {
                        let className = 'col-md-3 ' + video.className;
                        return <div className={className} onClick={(event) => { this.onClick(event, video.header, video.url)}} style={styles.clickContainer}>
                            <div className="card">
                                <div className="card-body" style={styles.cardBody}>
                                    <h3>{ video.header }</h3>
                                    <img src={video.thumbnail} style={styles.responsiveThumbnail} />
                                </div>
                            </div>
                        </div>
                    })}

                </div>
            </div>

        );
    }
}

VideoSearchBar.propTypes = {
    videos: PropTypes.string.isRequired
};

VideoSearchBar.defaultProps = {
    videos: {}
};

export default VideoSearchBar;

if (document.getElementById('video-search-bar')) {
    render(
        <VideoSearchBar />,
        document.getElementById('video-search-bar')
    );
}