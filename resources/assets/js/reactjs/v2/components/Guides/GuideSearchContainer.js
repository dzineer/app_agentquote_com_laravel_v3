import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import GuideSearchBar from "./GuideSearchBar";

/** function: GuideSearchContainer */
class GuideSearchContainer extends Component {
    constructor(props) {
        super(props);
        this.banner = '';
        this.eventArray = [];
        this.resultsContainer = '#video-results';

        this.onSearchChange = this.onSearchChange.bind(this);

        this.state = {
            loading: false,
            library: {
                guides: []
            },
            initial: {
                results: {
                    guides: []
                }
            },
            search: {
                header: "Search Results: Popular Carriers",
                results: {
                    guides: []
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
        console.log('GuideSearchContainer::[Component Did Mount]', 'I mounted');
        debugger;
        this.getPreferredGuides();
    }

    onSearchChange(event) {
        debugger;
        let value = event.target.value;

        if (!value.length) {
            let newState = Object.assign({} , this.state.search );
            // newState.results = this.state.initial.results;
            this.getPreferredGuides();

           return;
        }

        debugger;
        let searchResults = this.state.library.guides.filter( carrier => {
            let needle = value.toLowerCase();
            let search = carrier.name.toLowerCase();
            return search.indexOf( needle ) !== -1;
            /*carrier.categories = carrier.categories.filter( category => {
                category.guides = category.guides.filter( guide => {
                    let needle = value.toLowerCase();
                    let search = guide.name.toLowerCase();
                    return search.indexOf( needle ) !== -1;
                });
                return category.guides.length;
            });*/
            // return carrier.categories.length;
        });

        let changedState = Object.assign({} , this.state.search );
        changedState.header = "Search Results: " + value;
        changedState.results.guides = searchResults;
        this.setState({
            search: changedState
        });
    }

    getPreferredGuides()  {
        let url = '/support/guides';
        let that = this;
        axios.get(url).then( res => {
            console.log(res);
            if (res.status === 200) {

                console.log(res.data);
                let newState  = Object.assign({}, this.state);
                newState.library.guides = res.data.guides;

                res.data.guides = res.data.guides.filter( carrier => {
                    return carrier.popular === 1;
                });

                newState.initial.results.guides = res.data.guides;
                newState.search.results.guides = res.data.guides;
                newState.search.header = "Search Results: Popular Carriers";

                that.setState({
                    search: newState.search,
                    initial: newState.initial
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
            <GuideSearchBar header={this.state.search.header} guides={this.state.search.results.guides} onChange={this.onSearchChange} />
        );
    }
}

GuideSearchContainer.propTypes = {
};

GuideSearchContainer.defaultProps = {
};

export default GuideSearchContainer;

if (document.getElementById('guides-search-container')) {
    render(
        <GuideSearchContainer />,
        document.getElementById('guides-search-container')
    );
}
