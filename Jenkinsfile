node {
 	// Clean workspace before doing anything
    deleteDir()

    try {
        stage ('Clone') {
        	checkout scm
        }
        stage ('Build') {
		sh "echo 'shell scripts to deploy to server....'"
        }
        stage ('Tests') {
	        sh "echo 'shell scripts to deploy to server...'"
        }
	stage ('Push') {
		sh "echo 'shell scripts to deploy to server...'"
      	}   
      	stage ('Deploy') {
            sh "echo 'shell scripts to deploy to server...'"
      	}
    } catch (err) {
        currentBuild.result = 'FAILED'
        throw err
    }
}
