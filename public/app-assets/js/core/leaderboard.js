var recentData = [], alltimeData = [];

var Tabs = React.createClass({
  getInitialState: function() {
    return {activeTab: 'recent'};
  },
  
  setTab: function(tab) {
    this.setState({activeTab : tab});
  },
  
  render: function() {
    var recentClass = this.state.activeTab === 'recent' ? 'active' : '';
    var alltimeClass = this.state.activeTab === 'alltime' ? 'active' : '';
    displayData(this.state.activeTab);
    
    return (
      <ul className="nav nav-tabs">
        <li className={recentClass}><a href="#" onClick={this.setTab.bind(this, 'recent')}>30 Day Leaderboard</a></li>
        <li className={alltimeClass}><a href="#" onClick={this.setTab.bind(this, 'alltime')}>All Time Leaderboard</a></li>
      </ul>
    )
  }
});

var CamperList = React.createClass({
  render: function() {
    var camperNodes = this.props.data.map(function(camper, i) {
      return (
        <tr>
          <td className='col-md-1'>{i + 1}</td>
          <td className='col-md-5'><ProPic src={camper.img}/> <Camper name={camper.username}/></td>
          <td className='col-md-3'>{camper.recent}</td>
          <td className='col-md-3'>{camper.alltime}</td>
        </tr>
      )
    });
    
    return (
      <tbody className="camperList">
        {camperNodes}
      </tbody>
    )
  }
});

var ProPic = React.createClass({
  render: function() {
    return (
      <img className='proPic' src={this.props.src} width='40' height='40'/>
    )
  }
})

var Camper = React.createClass({
  render: function() {
    var profile = 'https://freecodecamp.com/' + this.props.name;
    return (
      <a className='camperName' href={profile}>{this.props.name}</a>
    )
  }
})

var SortLink = React.createClass({
  sortBy: function(criteria) {
    leaderboard.setState({
      data: _.sortBy(leaderboard.state.data, criteria).reverse(),
      sortBy: criteria
    });
  },
  
  render: function() {
    var criteria = this.props.criteria;
    return (
      <th>
        <a href='#' onClick={this.sortBy.bind(this, criteria)}>
          {this.props.children}
        </a>
      </th>
    )
  }
});

var TableHeader = React.createClass({
  render: function() {
    var fa = 'fa fa-caret-down';
    var i1 = this.props.sortBy === 'recent' ? fa : fa +  ' hidden';
    var i2 = this.props.sortBy === 'alltime' ? fa : fa + ' hidden';
    
    return (
      <thead>
        <tr>
          <th>Rank</th>
          <th>Camper</th>
          <SortLink criteria='recent'>Points in past 30 Days <i className={i1}></i></SortLink>
          <SortLink criteria='alltime'>All time points <i className={i2}></i></SortLink>
        </tr>
      </thead>
    )
  }
});

var Leaderboard = React.createClass({
  getInitialState: function() {
    return {
      data: [],
      sortBy: 'recent'
    };
  },
  
  componentDidMount: function() {
    getLeaderboardData('recent');
    
  },
  
  render: function() {
    return (
      <table className="table table-striped">
        <TableHeader sortBy={this.state.sortBy}/>
        <CamperList data={this.state.data}/>
      </table>
    )
  }
})

var tabs = ReactDOM.render(
  <Tabs/>,
  document.getElementById('tabContainer')
)

var leaderboard = ReactDOM.render(
  <Leaderboard/>,
  document.getElementById('tableContainer')
)

function getLeaderboardData(category) {
  $.getJSON( 'https://fcctop100.herokuapp.com/api/fccusers/top/' + category, 
    function(data) {
      if (category === 'recent') {
        recentData = data;
        getLeaderboardData('alltime');
      } else {
        alltimeData = data;
      }
      displayData(tabs.state.activeTab);
    });
}

function displayData(activeTab) {
  if (leaderboard) {
    var dataToDisplay = activeTab === 'recent' ? recentData : alltimeData;
    leaderboard.setState({
      data: _.sortBy(dataToDisplay, leaderboard.state.sortBy).reverse()
    });  
  }
}
            
