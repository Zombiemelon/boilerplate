pipeline {
    options { timeout(time: 15, unit: 'MINUTES') }
    agent any
    environment {
        CONTAINER_NAME='inex'
        ECR_ADDRESS='969243685974.dkr.ecr.eu-central-1.amazonaws.com/zombiemelon:latest'
    }
    stages {
        stage ('Test') {
            steps {
                sh 'docker build -t $CONTAINER_NAME -f ./docker/Dockerfile.test .'
                sh 'echo "Delete image"'
                sh 'docker image rm -f ${CONTAINER_NAME}'
            }
        }
        stage ('Build') {
            steps {
                sh 'docker build -t $CONTAINER_NAME -f ./docker/Dockerfile .'
                sh '$(/root/.local/bin/aws ecr get-login --no-include-email --region eu-central-1)'
                sh 'docker tag $CONTAINER_NAME $ECR_ADDRESS'
                sh 'docker push $ECR_ADDRESS'
                sh 'echo "Delete image"'
                sh 'docker image rm -f ${CONTAINER_NAME} && docker image prune -f'
            }
        }
        stage('Deploy') {
            steps {
                sshPublisher(publishers: [sshPublisherDesc(configName: 'customers_survey_aws', transfers: [sshTransfer(cleanRemote: false, excludes: '', execCommand: "\$(aws ecr get-login --no-include-email --region eu-central-1) && docker pull ${ECR_ADDRESS} && docker rm -f ${CONTAINER_NAME} ; docker run --name ${CONTAINER_NAME} -d -p 80:80 ${ECR_ADDRESS}", execTimeout: 120000, flatten: false, makeEmptyDirs: false, noDefaultExcludes: false, patternSeparator: '[, ]+', remoteDirectory: '', remoteDirectorySDF: false, removePrefix: '', sourceFiles: '')], usePromotionTimestamp: false, useWorkspaceInPromotion: false, verbose: false)])
            }
        }
    }
    post {
        always {
            cleanWs()
        }
    }
}