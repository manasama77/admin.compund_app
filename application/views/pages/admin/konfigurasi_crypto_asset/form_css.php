<style>
	@import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro');

	@keyframes pulse-red {
		0% {
			transform: scale(0.95);
			box-shadow: 0 0 0 0 rgba(255, 82, 82, 0.7);
		}

		70% {
			transform: scale(1);
			box-shadow: 0 0 0 10px rgba(255, 82, 82, 0);
		}

		100% {
			transform: scale(0.95);
			box-shadow: 0 0 0 0 rgba(255, 82, 82, 0);
		}
	}

	.blobs-container {
		display: flex;
	}

	.blob.red {
		background: rgba(255, 82, 82, 1);
		box-shadow: 0 0 0 0 rgba(255, 82, 82, 1);
		animation: pulse-red 2s infinite;
	}
</style>
