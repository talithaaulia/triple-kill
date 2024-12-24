pipeline {
    agent any

    stages {
        stage('Clone Repository') {
            steps {
                echo 'Cloning repository...'
                git 'https://github.com/talithaaulia/triple-kill.git'
            }
        }

        stage('Build Application') {
            steps {
                echo 'Building the application...'
                sh 'echo "Simulate build process"'
            }
        }

        stage('Run Tests') {
            steps {
                echo 'Running tests...'
                sh 'echo "Simulate test execution"'
            }
        }

        stage('Build Docker Image') {
            steps {
                echo 'Building Docker image...'
                sh 'docker build -t dongeng:1 .'
            }
        }

        stage('Push Docker Image') {
            steps {
                echo 'Pushing Docker image to Docker Hub...'
                withDockerRegistry([credentialsId: 'docker-credentials-id', url: 'https://index.docker.io/v1/']) {
                    sh 'docker push dongeng:1'
                }
            }
        }

        stage('Deploy to Production') {
            steps {
                echo 'Deploying to production...'
                sh 'echo "Simulate deployment process"'
            }
        }
    }

    post {
        always {
            echo 'Pipeline completed.'
        }
    }
}
