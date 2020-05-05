<template>
	<div class="jp-button-radio" @click="changeStatus">
		<span class="button-radio-button" :class="[{'active': radioStatus == true}]"></span>
	</div>
</template>

<script>
	export default {
		name: "ButtonRadio",
		data: function() {
			return {
				radioStatus: false
			};
		},
		methods: {
			changeStatus: function() {
				this.radioStatus = !this.radioStatus;
				this.$eventBus.$emit('radio-button-status', this.radioStatus);
			}
		},
		created: function() {
			if(this.$cookies.isKey('darkMode')) {
				if (this.$cookies.get('darkMode') == 'true') {
					this.radioStatus = true;
				} else {
					this.radioStatus = false;
				}
			}
		}
	};
</script>

<style lang="scss">
	.jp-button-radio {
		position: relative;
		width: 42px;
		height: 25px;
		border-radius: 50px;
		background-color: #fff;

		.button-radio-button {
			position: absolute;
			width: 21px;
			height: 21px;
			border-radius: 50%;
			background: #000;
			top: 50%;
			left: 0;
			transform: translateY(-50%) translateX(2px);
			transition: all ease-in-out .3s;
		}

		.button-radio-button.active {
			left: initial;
			right: 0;
			transform: translateY(-50%) translateX(-2px);
		}
	}
</style>