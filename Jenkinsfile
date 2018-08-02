node {
 	// Clean workspace before doing anything
    deleteDir()

    try {
        stage ('Clone') {
        	checkout scm
        }
        stage ('Build') {
		sh "docker-compose build"
		sh "docker-compose up -d" 
        }
        stage ('Tests') {
	        sh "chmod +x test.sh"
	        sh " ./test.sh"
        }
	stage ('Push') {
		sh '$(aws ecr get-login --no-include-email --region us-east-1)'
		sh "docker build -t rede-webserv ./Serv/Web/"
		sh "docker tag rede-webserv:latest 797409686075.dkr.ecr.us-east-1.amazonaws.com/rede-webserv:latest"
		sh "docker push 797409686075.dkr.ecr.us-east-1.amazonaws.com/rede-webserv:latest"
      	}   
      	stage ('Deploy') {
            sh "echo 'shell scripts to deploy to server...'"
      	}
    } catch (err) {
        currentBuild.result = 'FAILED'
        throw err
    }
}
