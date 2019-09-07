pipeline {
    options { timeout(time: 15, unit: 'MINUTES') }
    agent any
    environment {
        CONTAINER_NAME='inex'
        ECR_ADDRESS='276242186269.dkr.ecr.eu-central-1.amazonaws.com/inex'
    }
    stages {
        stage ('Build Back') {
            steps {
                sh 'ls -alh'
                sh 'docker build -t $CONTAINER_NAME:back -f ./docker/Dockerfile.staging.backend .'
                sh '$(/root/.local/bin/aws ecr get-login --no-include-email --region eu-central-1)'
                sh 'docker tag $CONTAINER_NAME:back $ECR_ADDRESS:back'
                sh 'docker push $ECR_ADDRESS'
                sh 'echo "Delete image"'
                sh 'docker image rm -f ${CONTAINER_NAME}:back && docker image prune -f'
            }
        }
//         stage ('Build Front') {
//             steps {
//                 sh 'docker build -t $CONTAINER_NAME:front -f ./docker/Dockerfile.staging.frontend . '
//                 sh '$(/root/.local/bin/aws ecr get-login --no-include-email --region eu-central-1)'
//                 sh 'docker tag $CONTAINER_NAME:front $ECR_ADDRESS:front'
//                 sh 'docker push $ECR_ADDRESS:front'
//                 sh 'echo "Delete image"'
//                 sh 'docker image rm -f ${CONTAINER_NAME}:front && docker image prune -f'
//             }
//         }

    }
    post {
        always {
            cleanWs()
            sh 'docker system prune -f'
        }
    }
}