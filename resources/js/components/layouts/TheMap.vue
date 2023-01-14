<template>
    <div id="mapContainer"></div>
</template>

<script>
import "leaflet/dist/leaflet.css";
import L from 'leaflet';

export default {
    inject: ['stations'],
    emits: ['set-station-marker'],

    data() {
        return {
            map: null,
            marker: '',
            status: false,
        };
    },

    watch: {
        status() {
            if(this.status) {
                this.initMap()
                this.fillMap();
            }
        }
    },

    methods: {
        //method called in AllStations and MyStations components when 'axios.get' is completed
        isFetched(value) {
            this.status = value;
        },

        initMap() {
            this.map = L.map("mapContainer", {
                center: [52.0693267, 19.4781225],
                zoom: 6,
                minZoom: 1,
                maxZoom: 16,
            });

            //prevent changing center of the map - works only with delay
            setTimeout(this.map.invalidateSize.bind(this.map), 10)

            const layer = L.tileLayer("https://api.maptiler.com/maps/basic-v2/{z}/{x}/{y}.png?key=3jWGVfYX2MWCGk1C4FEu", {
                attribution:
                    '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            })
            layer.addTo(this.map);
        },
        fillMap() {
            const markers = L.featureGroup();

            this.stations.forEach(station => {
                if (station.status === 'odwiedzona') {
                    const marker = L.circleMarker([station.lat, station.lon],
                        {
                            radius: 5,
                            weight: 1,
                            color: '#000000',
                            fillColor: '#14B8A6',
                            fillOpacity: 1
                        });
                    marker.title = station.name
                    marker.addTo(markers);
                } else if (station.status === 'przejechana') {
                    const marker = L.circleMarker([station.lat, station.lon],
                        {
                            radius: 5,
                            weight: 1,
                            color: '#000000',
                            fillColor: '#ffbf00',
                            fillOpacity: 1
                        });
                    marker.title = station.name
                    marker.addTo(markers);
                } else {
                    const marker = L.circleMarker([station.lat, station.lon],
                        {
                            radius: 4,
                            weight: 1,
                            color: '#000000',
                            fillColor: '#2784d3',
                            fillOpacity: 1
                        });
                    marker.title = station.title
                    marker.addTo(markers);
                }
            })

            //emit event - pass station.title to parent's component when marker is clicked
            markers.on("click", (event) => {
                this.$emit('set-station-marker', event.layer.title);
            });
            markers.addTo(this.map);
        }
    }
}
</script>

<style>
#mapContainer {
    position: sticky;
    height: 100%;
    width: 100%;
}
</style>
