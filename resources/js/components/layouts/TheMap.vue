<template>

    <l-map
        :zoomAnimation="true"
        :minZoom="2"
        :maxZoom="14"
        :zoom="zoom"
        :center="center"
    >
        <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>

        <l-circle-marker
            v-for="station in stations"
            :lat-lng="[station.lat, station.lon]"

            :radius="6"
            :color="'#008080'"
            :fill="true"
            :fillColor="'#008080'"
            :fillOpacity="0.8"
            :stroke="false"

        >
        <l-tooltip>
            {{ station.title }}
        </l-tooltip>
        </l-circle-marker>

    </l-map>
</template>

<script>


import {
    LMap,
    LIcon,
    LTileLayer,
    LCircle,
    LControlZoom,
    LPopup,
    LFeatureGroup,
    LTooltip,
    LCircleMarker
} from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";

export default {
    inject: ['stations'],

    components: {
        LMap,
        LIcon,
        LTileLayer,
        LCircle,
        LControlZoom,
        LPopup,
        LFeatureGroup,
        LTooltip,
        LCircleMarker
    },

    data() {
        return {
            url: 'https://api.maptiler.com/maps/basic-v2/{z}/{x}/{y}.png?key=3jWGVfYX2MWCGk1C4FEu',
            attribution:
                '&copy; <a target="_blank" href="http://osm.org/copyright">OpenStreetMap</a> contributors',

            center: [52.0693267, 19.4781225],

            zoom: 6.5,
        };
    },
}

</script>
