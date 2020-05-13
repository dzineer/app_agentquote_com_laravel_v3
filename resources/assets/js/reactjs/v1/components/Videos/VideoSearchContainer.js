import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import VideoSearchBar from "./VideoSearchBar";
import QuoteResult from "../Quoter/TermlifeForm";

/** function: VideoSearchContainer */
class VideoSearchContainer extends Component {
    constructor(props) {
        super(props);
        this.banner = '';
        this.eventArray = [];
        this.resultsContainer = '#video-results';

        this.onSearchChange = this.onSearchChange.bind(this);

        this.state = {
            loading: false,
            library: {
                videos: [/*
                    { "header": "General Setup", "url": "https://player.vimeo.com/video/317978590", className: "mt-4" },
                    { "header": "Product Input", "url": "https://player.vimeo.com/video/317978934", className: "mt-4" },
                    { "header": "FE", "url": "https://player.vimeo.com/video/317984214", className: "mt-4" },
                    { "header": "SI Term", "url": "https://player.vimeo.com/video/317985649", className: "mt-4" },
                    { "header": "Term Life", "url": "https://player.vimeo.com/video/317986659", className: "mt-4" },
                */]
            },
            search: {
                results: {
                    videos: [
                      /*  { "header": "General Setup", "url": "https://player.vimeo.com/video/317978590", className: "mt-4" },
                        { "header": "Product Input", "url": "https://player.vimeo.com/video/317978934", className: "mt-4" },
                        { "header": "FE", "url": "https://player.vimeo.com/video/317984214", className: "mt-4" },
                        { "header": "SI Term", "url": "https://player.vimeo.com/video/317985649", className: "mt-4" },
                        { "header": "Term Life", "url": "https://player.vimeo.com/video/317986659", className: "mt-4" },*/
                    ]
                }
            }

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
        console.log('VideoSearchContainer::[Component Did Mount]', 'I mounted');
        debugger;
        this.getPreferredVideos();
    }

    onSearchChange(event) {
        debugger;
        let value = event.target.value;
        let searchResults = this.state.library.videos.filter( video => {
           let needle = value.toLowerCase();
           let search = video.header.toLowerCase();
           return search.indexOf( needle ) !== -1;
        });

        let newState = Object.assign({} , this.state.search );
        newState.results.videos = searchResults;

        this.setState({
            search: newState
        });
    }

    getPreferredVideos()  {
        let url = '/support/videos';
        let that = this;
        axios.get(url).then( res => {
            console.log(res);
            if (res.status === 200) {

                console.log(res.data);
                let newState  = Object.assign({}, this.state);
                newState.library.videos = res.data.videos;

                let listVideos = res.data.videos.filter( video => {
                    return video.preferred === 1;
                });
                newState.search.results.videos = listVideos;

                that.setState({
                    results: newState
                });
             }
        });

    }

    render() {
        const { loading } = this.state;
        if(loading) { // if your component doesn't have to wait for an async action, remove this block
            return null; // render null when app is not ready
        }

        return (

            <div>
                <VideoSearchBar videos={this.state.search.results.videos} onChange={this.onSearchChange} />
                <div id="modal-container" />
            </div>
        );
    }
}

VideoSearchContainer.propTypes = {
};

VideoSearchContainer.defaultProps = {
};

export default VideoSearchContainer;

if (document.getElementById('video-search-container')) {
    render(
        <VideoSearchContainer />,
        document.getElementById('video-search-container')
    );
}
